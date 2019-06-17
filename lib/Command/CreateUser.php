<?php

namespace OCA\UserCAS\Command;

use OCA\UserCAS\Service\AppService;
use OCA\UserCAS\Service\LoggingService;
use OCA\UserCAS\Service\UserService;

use OCA\UserCAS\User\Backend;
use OCA\UserCAS\User\NextBackend;
use OCP\IGroupManager;
use OCP\IUser;
use OCP\IUserManager;
use OCP\Mail\IMailer;
use OC\Files\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;


/**
 * Class CreateUser
 *
 * @package OCA\UserCAS\Command
 *
 * @author Felix Rupp <kontakt@felixrupp.com>
 * @copyright Felix Rupp <kontakt@felixrupp.com>
 *
 * @since 1.7.0
 */
class CreateUser extends Command
{

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var AppService
     */
    protected $appService;

    /**
     * @var IUserManager
     */
    protected $userManager;

    /**
     * @var IGroupManager
     */
    protected $groupManager;

    /**
     * @var IMailer
     */
    protected $mailer;

    /**
     * @var LoggingService
     */
    protected $loggingService;


    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $userManager = \OC::$server->getUserManager();
        $groupManager = \OC::$server->getGroupManager();
        $mailer = \OC::$server->getMailer();
        $config = \OC::$server->getConfig();
        $userSession = \OC::$server->getUserSession();
        $logger = \OC::$server->getLogger();
        $urlGenerator = \OC::$server->getURLGenerator();

        $loggingService = new LoggingService('user_cas', $config, $logger);
        $this->appService = new AppService('user_cas', $config, $loggingService, $userManager, $userSession, $urlGenerator);

        /** @var \OCP\Defaults $defaults */
        $defaults = new \OCP\Defaults();
        $version = \OCP\Util::getVersion();

        if (strpos(strtolower($defaults->getName()), 'next') !== FALSE && $version[0] >= 14) {

            $backend = new NextBackend(
                $loggingService,
                $this->appService
            );
        } else {

            $backend = new Backend(
                $loggingService,
                $this->appService
            );
        }

        $userService = new UserService(
            'user_cas',
            $config,
            $userManager,
            $userSession,
            $groupManager,
            $this->appService,
            $backend,
            $loggingService
        );

        $this->userService = $userService;
        $this->userManager = $userManager;
        $this->groupManager = $groupManager;
        $this->mailer = $mailer;
        $this->loggingService = $loggingService;
    }


    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('cas:create-user')
            ->setDescription('Adds a user_cas user to the database.')
            ->addArgument(
                'uid',
                InputArgument::REQUIRED,
                'User ID used to login (must only contain a-z, A-Z, 0-9, -, _ and @).'
            )
            ->addOption(
                'display-name',
                null,
                InputOption::VALUE_OPTIONAL,
                'User name used in the web UI (can contain any characters).'
            )
            ->addOption(
                'email',
                null,
                InputOption::VALUE_OPTIONAL,
                'Email address for the user.'
            )
            ->addOption(
                'group',
                'g',
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'The groups the user should be added to (The group will be created if it does not exist).'
            )
            ->addOption(
                'quota',
                'o',
                InputOption::VALUE_OPTIONAL,
                'The quota the user should get either as numeric value in bytes or as a human readable string (e.g. 1GB for 1 Gigabyte)'
            )
            ->addOption(
                'enabled',
                'e',
                InputOption::VALUE_OPTIONAL,
                'Set user enabled'
            );
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $uid = $input->getArgument('uid');
        if ($this->userManager->userExists($uid)) {
            $output->writeln('<error>The user "' . $uid . '" already exists.</error>');
            return 1;
        }

        // Validate email before we create the user
        if ($input->getOption('email')) {
            // Validate first
            if (!$this->mailer->validateMailAddress($input->getOption('email'))) {
                // Invalid! Error
                $output->writeln('<error>Invalid email address supplied</error>');
                return 1;
            } else {
                $email = $input->getOption('email');
            }
        } else {
            $email = null;
        }

        # Register Backend
        $this->userService->registerBackend();

        /**
         * @var IUser
         */
        $user = $this->userService->create($uid);

        if ($user instanceof IUser) {

            $output->writeln('<info>The user "' . $user->getUID() . '" was created successfully</info>');
        } else {

            $output->writeln('<error>An error occurred while creating the user</error>');
            return 1;
        }

        # Set displayName
        if ($input->getOption('display-name')) {

            $user->setDisplayName($input->getOption('display-name'));
            $output->writeln('Display name set to "' . $user->getDisplayName() . '"');
        }

        # Set email if supplied & valid
        if ($email !== null) {

            $user->setEMailAddress($email);
            $output->writeln('Email address set to "' . $user->getEMailAddress() . '"');
        }

        # Set Groups
        $groups = $input->getOption('group');

        if (!empty($groups)) {

            // Make sure we init the Filesystem for the user, in case we need to
            // init some group shares.
            Filesystem::init($user->getUID(), '');
        }

        foreach ($groups as $groupName) {

            $group = $this->groupManager->get($groupName);
            if (!$group) {
                $this->groupManager->createGroup($groupName);
                $group = $this->groupManager->get($groupName);
                $output->writeln('Created group "' . $group->getGID() . '"');
            }
            $group->addUser($user);
            $output->writeln('User "' . $user->getUID() . '" added to group "' . $group->getGID() . '"');
        }

        # Set Quota
        $quota = $input->getOption('quota');

        if (!empty($quota)) {

            if (is_numeric($quota)) {

                $newQuota = $quota;
            } elseif ($quota === 'default') {

                $newQuota = 'default';
            } else {

                $newQuota = \OCP\Util::computerFileSize($quota);
            }

            $user->setQuota($newQuota);
            $output->writeln('Quota set to "' . $user->getQuota() . '"');
        }

        # Set enabled
        $enabled = $input->getOption('enabled');

        if (is_numeric($enabled) || is_bool($enabled)) {

            $user->setEnabled(boolval($enabled));

            $enabledString = ($user->isEnabled()) ? 'enabled' : 'not enabled';
            $output->writeln('Enabled set to "' . $enabledString . '"');
        }

        # Set Backend
        if ($this->appService->isNotNextcloud()) {

            if (!is_null($user) && ($user->getBackendClassName() === 'OC\User\Database' || $user->getBackendClassName() === "Database")) {

                $query = \OC_DB::prepare('UPDATE `*PREFIX*accounts` SET `backend` = ? WHERE LOWER(`user_id`) = LOWER(?)');
                $result = $query->execute([get_class($this->userService->getBackend()), $uid]);

                $output->writeln('New user added to CAS backend.');
            }

        } else {

            $output->writeln('This is a Nextcloud instance, no backend update needed.');
        }
    }
}