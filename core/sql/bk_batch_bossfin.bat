For /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set mydate=%%c-%%a-%%b)
c:\xampp\mysql\bin\mysqldump -u bossfin --password="AXUcs97@486@$#er587" --opt bossfin --port="9575" > c:\xampp\www\bossfin\core\sql\bossfin_%mydate%.sql
