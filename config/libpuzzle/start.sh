wget http://download.pureftpd.org/pub/pure-ftpd/misc/libpuzzle/releases/libpuzzle-0.11.tar.bz2 -P .
tar -jxvf libpuzzle-0.11.tar.bz2 -C .
git clone https://github.com/boobooking/libpuzzle.git
cp -pR ./libpuzzle/* ./libpuzzle-0.11

cd libpuzzle-0.11 \
&& ./configure --with-libpuzzle \
&& make clean \
&& make \
&& make install

cd libpuzzle-0.11/php/libpuzzle \
cp -p config0.m4 config.m4 \
&& phpize \
&& ./configure --with-libpuzzle \
&& make \
&& make install
