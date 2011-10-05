FILES=/var/www/library/web/uploads/spend/*.csv
for f in $FILES
do
 echo "Processing $f file..."
  # take action on each file. $f store current file name
  
  php /var/www/library/lib/loadspend.php $f
done
