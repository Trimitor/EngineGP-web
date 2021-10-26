<?php 

if (!class_exists('FtpCache', false)) {

	class FtpCache
	{
		
		public $filename = '';

		public function __construct( $server, $cache_expires ) 
		{
			
			$this->filename = ROOTPATH . 'ftpcache/csstats_' . $server[ 'ip' ] . '.' . $server[ 'port' ] . '.dat';
			
			// Проверка свежести кэшированного csstats.dat
			if( time() - (int)filectime( $this->filename ) > $cache_expires )
			{

				// подключение к FTP
				if( $ftp = ftp_connect( $server[ 'ftp_host' ], $server[ 'ftp_port' ], 1 ) )
				{
							
					// Логин FTP
					if( ftp_login( $ftp, $server[ 'ftp_user' ], $server[ 'ftp_pass' ] ) )
					{
							
						// Переход в папку на FTP
						if( ftp_chdir( $ftp, $server[ 'ftp_path' ] ) )
						{
							
							// Скачивание csstats.dat
							if( ftp_get( $ftp, $this->filename, $server[ 'ftp_path' ] . '/csstats.dat', FTP_BINARY ) )
							{
									
								// OK
									
							} else {
								
								throw new FtpCacheException("ftp_get error.");
								
							}
								
						} else {
							
							throw new FtpCacheException("ftp_chdir error.");
							
						}
							
					} else {
						
						throw new FtpCacheException("ftp_login error.");
						
					}
						
				} else {
						
					throw new FtpCacheException("ftp_connect error.");
				
				}		
				
			} 

		}
		
	}

}

if (!class_exists('FtpCacheException', false)) {
	/**
	 * This is exception class for CSstats class.
	 * @author kajoj
	 * @package CSstats
	 */
	class FtpCacheException extends Exception {}
}

?>