#!/bin/bash
# Question 4

echo -n "Enter directory_path: "
read directory
echo -n "Enter filename_pattern: "
read pattern
echo -n "Enter the new_filename: "
read newFileName


cd $directory

fileCount=1

for file in *
do
    num=0
    currentFileName="$(basename -- "$file")"
    currentFileExtension="${currentFileName##*.}"
    for ((i=0; i < ${#currentFileName} && num < ${#pattern}; i++))
    do
        if [ "${currentFileName:$i:1}" == ${pattern:$num:1} ]
        then
            num=$(($num + 1))
        fi
    done
    if [ $num -eq ${#pattern} ]
    then
        newName=${newFileName}_${fileCount}.${currentFileExtension}
        $(mv $file $newName)
        ((fileCount++))
    fi
done
