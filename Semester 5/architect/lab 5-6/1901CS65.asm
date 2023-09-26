# Tarusi Mittal
# 1901CS65
# LAB 5-6

.data
alen: .word 4
temp: .space 400
array: .space 400
asklen: .asciiz "Enter the length of the array: "
msg1: .asciiz "Enter the numbers in the array:\n"
msg2: .asciiz "Final Array after performing Merge Sort:\n"
endl: .asciiz "\n"

.text

.globl main

j main                  #jump to main

merge_sort:
        bge $a1,$a2,return     #a1=startadress #a2=lastaddress

        # calculating mid element's address which is $a3
        sub $t0,$a2,$a1       #t0=a2-a1
        div $t0,$t0,4         #it will give the length
        div $t0,$t0,2         #to calculate the middle
        mul $t0,$t0,4         #to calculate the address
        add $a3,$a1,$t0       #a3=a2+t0 => start+mid

        sub $sp,$sp,4        # Adjust stack pointer
        sw $ra,0($sp)        # Store the return address on the stack
        sub $sp,$sp,4
        sw $a1,0($sp)        # Store the array start address on the stack
        sub $sp,$sp,4
        sw $a2,0($sp)        # Store the array end address on the stack
        sub $sp,$sp,4
        sw $a3,0($sp)        # Store the array middle address on the stack


        move $a2,$a3         #store a3 into a2 =>end pointer is now the middle of the previous array
        jal merge_sort       #recursive call for (initial to mid)

        lw $a1,0($sp)        #mid value in a1
        lw $a2,4($sp)        #high value in a2
        add $a1,$a1,4        #a1++;
        jal merge_sort       #recursive call for(mid to high)

        lw $t1,8($sp)        #load low from stack
        lw $t3,0($sp)        #load mid from stack
        lw $t4,4($sp)        #load high from stack
        add $t2,$t3,4        #new low = mid+1
        la $t0,temp          #temp is our temp array t0=temp array

        merge_loop:
                bgt $t1,$t3,done_merge    #if low>mid then go to done
                bgt $t2,$t4,done_merge    #if mid+1>high then done

                lw $t5,0($t1)            #t5=t1 =>low initial of first
                lw $t6,0($t2)            #t6=t2 =>mid+1

                blt $t6,$t5,store2       #if t6<t5 then we will first store t6

                #take the lower values and store them in t0 which is our temp
                store1:
                        sw $t5,0($t0)
                        add $t1,$t1,4   #t1 incremented
                        j donestore
                store2:
                        sw $t6,0($t0)
                        add $t2,$t2,4   #t2 incremented

                donestore:

                add $t0,$t0,4      #increment t0
                j merge_loop       #jump to merge sort

        done_merge:


        append1:
                bgt $t1,$t3,done_append1  #if low>mid then stop otherwise loop will rn
                lw $t5,0($t1)             #load t1 in t5
                sw $t5,0($t0)             #store t5 in t0
                add $t1,$t1,4             #t1++
                add $t0,$t0,4             #t0++
                j append1                 #run loop again
        done_append1:

        append2:
                bgt $t2,$t4,done_append2   # same as append 1
                lw $t6,0($t2)
                sw $t6,0($t0)
                add $t2,$t2,4
                add $t0,$t0,4
                j append2
        done_append2:

        copying_to_original_array_from_temp:
                lw $a1,8($sp)    #load low from stack
                lw $a2,4($sp)    #load high from stack
                la $t0,temp      # start temp array

                copy_loop:
                        bgt $a1,$a2,done_copying   # if low>high then done
                        lw $t1,0($t0)              #load t0 in t1
                        sw $t1,0($a1)              #store t1 in a1
                        add $t0,$t0,4              #t0++;
                        add $a1,$a1,4              #a1++;
                        j copy_loop
        done_copying:


        lw $ra,12($sp)   #return
        add $sp,$sp,16

        return:
        jr $ra          #end function

main:
        takeinputs:
                li $v0,4          #print statement for length of array
                la $a0,asklen
                syscall

                la $t0,alen       #t0 stores the length
                li $v0,5
                syscall
                sw $v0,0($t0)       #store into to t0

                li $v0,4
                la $a0,msg1
                syscall

                la $s1,array
                la $s2,array         #s2 will store how much length we need;
                lw $t0,alen
                mul $t0,$t0,4        #length*4
                add $s2,$s2,$t0      #s2=s2+t0
                sub $s2,$s2,4        #so that we dont exceed the array size

                move $t0,$s1         #store s1 into t0

                loop:
                        bgt $t0,$s2,doneinput     #if t0>last address then done
                        li $v0,5                  # take input
                        syscall
                        sw $v0,0($t0)             #arr[i]=input

                        add $t0,$t0,4             #i++
                        j loop
        doneinput:
        move $a1,$s1      #store s1 into a1  It is the intiital address
        move $a2,$s2      #store s2 into a2  It is the last adress

        jal merge_sort    #jump and link


        # outputting the new array
	displayoutput:
		li $v0,4
		la $a0, msg2
		syscall

		move $t0,$s1

		outputloop:
			bgt $t0,$s2, doneoutput

			li $v0, 4
			la $a0, endl
			syscall

			li $v0, 1
			lw $a0, 0($t0)
			syscall

			addi $t0,$t0,4
			j outputloop
	doneoutput:

        exit:
		li $v0, 10
		syscall
