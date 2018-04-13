#/bin/sh
# G. Oij 6/2014
# Modified 2/2017
# aim

# check for legit number of degrees and converts degrees over 90 to
# the corresponding number of degrees under 90 and likewise the other way

cd /var/www/html/python
if [ $# -ne 1 ]; then
        echo "Usage: $0 NUMBER_OF_DEGREES (where NUMBER OF DEGREES is between 0 and 180)"
        exit 1
fi
DEGREES=$1
if [ $DEGREES -lt 0 ]; then
        echo "Need more degrees."
        echo "Usage: $0 NUMBER_OF_DEGREES (where NUMBER OF DEGREES is between 0 and 180)"
        exit 1
fi
if [ $DEGREES -gt 180 ]; then
        echo "Too many degrees"
        echo "Usage: $0 NUMBER_OF_DEGREES (where NUMBER OF DEGREES is between 0 and 180)"
        exit 1
fi

# Invert the angle; the way I mount them is off by 180 degrees ...
# Over 90 > under 90; example - aim 80 is converted to aim 100.

if [ $DEGREES -gt 90 ]; then
        MOVE=`expr $DEGREES - 90`
        DEGREES=`expr 90 - $MOVE`

elif [ $DEGREES -lt 90 ]; then
        MOVE=`expr 90 - $DEGREES`
        DEGREES=`expr 90 + $MOVE`
fi

sudo python hor.py $DEGREES
