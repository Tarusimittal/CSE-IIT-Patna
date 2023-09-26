#!/bin/bash
# Question 2

read A
read B
if [ $A -gt $B ]
then
    echo "Error: Wrong Range given."

else 
    while [ $A -le $B ]
    do
        echo -n "$A "
        A=$(($A + 1)) 
    done
    echo ""
fi
