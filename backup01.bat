set yy=%date:~-4%
set mm=%date:~-7,2%
set dd=%date:~-10,2%
set MYDATE=%yy%%mm%%dd%
cd c:\Users\u2\Documents\dumps
IF NOT EXIST %yy%%mm% MKDIR %yy%%mm%
cd %yy%%mm%
mysqldump --single-transaction --quick -u root -h 192.168.1.2 refill_mlm | gzip > dump_%MYDATE%_0100.sql.gz