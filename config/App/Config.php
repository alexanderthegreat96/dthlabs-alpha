<?php
namespace LexSystems\Framework\Config\App;
class Config
{
    /**
     * Default storage location
     */
    const STORAGE_LOCATION = 'files';

    /**
     * Default upload location
     */
    const UPLOADS_LOCATION = 'uploads';

    /**
     * Max upload size
     * 9MBs
     */
    const MAX_UPLOAD_SIZE = 9000000;

    /**
     * Default app location
     * must be relative to the current root directory
     * ex:https://sotename.com/{project}
     * ex:https://{project}.com for empty
     */
    const APP_LOCATION = '/projects/dthlabs-alpha';

    /**
     * App key that can be used for various things
     * currently mapped to sessions
     * to support multiple app instances accross the same domain
     */

    const APP_KEY = 'dthlabs-alpha';

    /**
     * No trailing slash
     */

    const FULL_PATH_LOCATION = '/var/www/html/projects/dthlabs-alpha';

    /**
     * Default website location
     */
    const APP_URL = 'http://192.168.1.69/projects/dthlabs-alpha';

    /**
     * default app name
     */

    const APP_NAME = 'DthLabs ALPHA';
}
