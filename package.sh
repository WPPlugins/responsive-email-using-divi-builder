dest='responsive-email-using-divi-builder';
rm -f /tmp/$dest*.zip;
rm -rf /tmp/$dest;
mkdir -p /tmp/$dest;
cp -r * /tmp/$dest;
cd /tmp;
cd $dest;
rm -f package.sh;
rm -f reset.sh;
rm -f new-user.html;
rm -f reset.html;
rm -rf .git;
rm -f .*;
rm -f phpunit.xml.dist;
cd ..;
zip -r9 $dest.zip $dest;