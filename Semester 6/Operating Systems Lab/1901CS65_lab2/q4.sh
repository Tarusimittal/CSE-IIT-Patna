#!/bin/bash
# Problem 4
if [ $# -ne 1 ]; 
then
	echo "Error: Invalid arguments (write password within double inverted commas)"
	exit 1
fi

# Noting password and its length
password=$1
length=${#password}
echo "Password Entered: $1"
echo "Length of Password: $length"

# Password requirements
alphabet="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
numbers="0123456789"
specialChar="/()<>?"
# function to check password requiremnts
function Verify() {
	# $1 is basically the set of characters whose presence is to be checked
	set=$1
	for ((i = 0; i < $length; ++i))
    do
		for ((j = 0; j < ${#set}; ++j))
        do
			if [ ${password:i:1} == ${set:j:1} ]; 
			then
				echo 1
				return
			fi
		done
	done
	echo 0
    return					
}

# Validating presence of characters as per problem statement
if [ $length -ge 7 ] && [ $(Verify "$alphabet") -eq 1 ]  && [ $(Verify "$numbers") -eq 1 ] && [ $(Verify "$specialChar") -eq 1 ]; then
	echo "<Valid Password>"
else
	echo "<Invalid Password>"
fi
