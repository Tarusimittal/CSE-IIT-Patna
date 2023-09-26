#!/bin/bash
# Question 1

if [ $# -eq 0 ]
then
    echo "Error: Zero arguments passed\n"

elif [ $# -gt 1 ]
then
    echo "Error: More than one arguments passed.\n"

else
    number=$1
    result=0
    while [ $number -ne 0 ]
    do
        result=$(($result * 10 + $number % 10))
        number=$(($number / 10))
    done
    echo $result
fi