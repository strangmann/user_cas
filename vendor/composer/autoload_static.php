<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1321a66a41698a12ee93a4744994e8a5
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'E' => 
        array (
            'EcasPhpCASParser\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'EcasPhpCASParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/ec-europa/ecas-phpcas-parser/src',
        ),
    );

    public static $classMap = array (
        'CAS_AuthenticationException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/AuthenticationException.php',
        'CAS_Client' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Client.php',
        'CAS_CookieJar' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/CookieJar.php',
        'CAS_Exception' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Exception.php',
        'CAS_GracefullTerminationException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/GracefullTerminationException.php',
        'CAS_InvalidArgumentException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/InvalidArgumentException.php',
        'CAS_Languages_Catalan' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/Catalan.php',
        'CAS_Languages_ChineseSimplified' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/ChineseSimplified.php',
        'CAS_Languages_English' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/English.php',
        'CAS_Languages_French' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/French.php',
        'CAS_Languages_Galego' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/Galego.php',
        'CAS_Languages_German' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/German.php',
        'CAS_Languages_Greek' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/Greek.php',
        'CAS_Languages_Japanese' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/Japanese.php',
        'CAS_Languages_LanguageInterface' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/LanguageInterface.php',
        'CAS_Languages_Portuguese' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/Portuguese.php',
        'CAS_Languages_Spanish' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Languages/Spanish.php',
        'CAS_OutOfSequenceBeforeAuthenticationCallException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/OutOfSequenceBeforeAuthenticationCallException.php',
        'CAS_OutOfSequenceBeforeClientException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/OutOfSequenceBeforeClientException.php',
        'CAS_OutOfSequenceBeforeProxyException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/OutOfSequenceBeforeProxyException.php',
        'CAS_OutOfSequenceException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/OutOfSequenceException.php',
        'CAS_PGTStorage_AbstractStorage' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/PGTStorage/AbstractStorage.php',
        'CAS_PGTStorage_Db' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/PGTStorage/Db.php',
        'CAS_PGTStorage_File' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/PGTStorage/File.php',
        'CAS_ProxiedService' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService.php',
        'CAS_ProxiedService_Abstract' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService/Abstract.php',
        'CAS_ProxiedService_Exception' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService/Exception.php',
        'CAS_ProxiedService_Http' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService/Http.php',
        'CAS_ProxiedService_Http_Abstract' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService/Http/Abstract.php',
        'CAS_ProxiedService_Http_Get' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService/Http/Get.php',
        'CAS_ProxiedService_Http_Post' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService/Http/Post.php',
        'CAS_ProxiedService_Imap' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService/Imap.php',
        'CAS_ProxiedService_Testable' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxiedService/Testable.php',
        'CAS_ProxyChain' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxyChain.php',
        'CAS_ProxyChain_AllowedList' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxyChain/AllowedList.php',
        'CAS_ProxyChain_Any' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxyChain/Any.php',
        'CAS_ProxyChain_Interface' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxyChain/Interface.php',
        'CAS_ProxyChain_Trusted' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxyChain/Trusted.php',
        'CAS_ProxyTicketException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/ProxyTicketException.php',
        'CAS_Request_AbstractRequest' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Request/AbstractRequest.php',
        'CAS_Request_CurlMultiRequest' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Request/CurlMultiRequest.php',
        'CAS_Request_CurlRequest' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Request/CurlRequest.php',
        'CAS_Request_Exception' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Request/Exception.php',
        'CAS_Request_MultiRequestInterface' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Request/MultiRequestInterface.php',
        'CAS_Request_RequestInterface' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Request/RequestInterface.php',
        'CAS_Session_PhpSession' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/Session/PhpSession.php',
        'CAS_TypeMismatchException' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS/TypeMismatchException.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'phpCAS' => __DIR__ . '/..' . '/jasig/phpcas/source/CAS.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1321a66a41698a12ee93a4744994e8a5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1321a66a41698a12ee93a4744994e8a5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1321a66a41698a12ee93a4744994e8a5::$classMap;

        }, null, ClassLoader::class);
    }
}
