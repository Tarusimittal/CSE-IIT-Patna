# Tarusi Mittal
# 1901CS65
# MIDSEM LAB

.data
alen: .word 4
curr: .space 400
array: .space 400
k: .word 4
asklen: .asciiz "Enter the length of the array: "
msg1: .asciiz "Enter the numbers in the array:\n"
msg2: .asciiz "Final Array after Sorting:"
askk: .asciiz "Enter the value of k:"
msg3: .asciiz "Kth smallest element in the array is: \n"
endl: .asciiz "\n"

.text

.globl main

j main                  #jump to main

sorting_array:
        bge $a1,$a2,return     #a1=startaddress #a2=lastaddress

        # calculating mid element's address which is $a3
        sub $t0,$a2,$a1       #t0=a2-a1
        div $t0,$t0,4         #it will give the length
        div $t0,$t0,2         #to calculate the middle
        sll $t0,$t0,2         #to calculate the address
        add $a3,$a1,$t0       #a3=a2+t0 => start+mid

        sub $sp,$sp,16        # Adjust stack pointer
        sw $ra,12($sp)        # Store the return address on the stack
        sw $a1,8($sp)        # Store the array start address on the stack
        sw $a2,4($sp)        # Store the array end address on the stack
        sw $a3,0($sp)        # Store the array middle address on the stack


        move $a2,$a3         #store a3 into a2 =>end pointer is now the middle of the previous array
        jal sorting_array       #recursive call for (initial to mid)

        lw $a2,4($sp)        #high value in a2
        lw $a1,0($sp)        #mid value in a1
        add $a1,$a1,4        #a1++;
        jal sorting_array       #recursive call for(mid to high)

        lw $t1,8($sp)        #load low from stack
        lw $t4,4($sp)        #load high from stack
        lw $t3,0($sp)        #load mid from stack
        add $t2,$t3,4        #new low = mid+1
        la $t0,curr          #curr is our temporary array t0=curr array

        merge_loop:
                slt $t9, $t4, $t2      #set if less than(slt) if(t4<t2) then t9=1
                beq $t9,1,travel1      #if mid+1>high then go to travel1
                slt $t9, $t3, $t1      #set if less than(slt) if(t3<t1) then t9=1
                beq $t9,1,travel1      #if low>mid then go to travel1

                lw $t5,0($t1)            #t5=t1 =>low initial of first
                lw $t6,0($t2)            #t6=t2 =>mid+1

                blt $t6,$t5,store2       #if t6<t5 then we will first store t6

                #take the lower values and store them in t0 which is our curr
                store1:
                        sw $t5,0($t0)
                        li $t8,4
                        add $t1,$t1,$t8   #t1 incremented
                        j donestore
                store2:
                        sw $t6,0($t0)
                        li $t8,4
                        add $t2,$t2,$t8   #t2 incremented

                donestore:

                add $t0,$t0,4      #increment t0
                j merge_loop       #jump to merge sort


        travel1:
                slt $t9, $t3, $t1
                beq $t9,1,travel2         #if low>mid then stop otherwise loop will run
                lw $t5,0($t1)             #load t1 in t5
                sw $t5,0($t0)             #store t5 in t0
                li $t8,4
                add $t0,$t0,$t8           #t0++
                add $t1,$t1,$t8           #t1++
                j travel1                 #run loop again

        travel2:
                slt $t9, $t4, $t2         #same as travel1
                beq $t9,1, done_travel
                lw $t6,0($t2)
                sw $t6,0($t0)
                li $t8,4
                add $t0,$t0,$t8
                add $t2,$t2,$t8
                j travel2
        done_travel:

        copy_back_array:
                la $t0,curr      # start curr array
                lw $a1,8($sp)    #load low from stack
                lw $a2,4($sp)    #load high from stack

                copy_loop:
                        slt $t9,$a2,$a1
                        beq $t9,1,done_copying     # if low>high then done
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

                li $v0,4          #print statement for k
                la $a0,askk
                syscall

                la $t3,k       #t3 stores the length
                li $v0,5
                syscall
                sw $v0,0($t3)       #store into to t3

                li $v0,4        #print statemnet for length of array
                la $a0,msg1
                syscall

                lw $t0,alen
                lw $t3,k

                la $s2,array         #s2 will store how much length we need;
                la $s1,array
                la $s3,array

                sll $t0,$t0,2        #length*4
                add $s2,$s2,$t0      #s2=s2+t0
                add $s2,$s2,-4       #so that we dont exceed the array size

                sll $t3,$t3,2        #length for k
                add $s3,$s3,$t3
                add $s3,$s3,-4

                move $t0,$s1         #store s1 into t0

                loop:
                        slt $t9, $s2, $t0
                        beq $t9,1,inputextend     #if t0>last address then done
                        li $v0,5                  # take input
                        syscall
                        sw $v0,0($t0)             #arr[i]=input

                        add $t0,$t0,4             #i++
                        j loop
        inputextend:

        move $a2,$s2      #store s2 into a2  It is the last address
        move $a1,$s1      #store s1 into a1  It is the initial address

        jal sorting_array    #jump and link



        # outputting the new array and value of kth smallest element

	displayoutput:
		li $v0,4
		la $a0, msg2
		syscall

		move $t0,$s1

		outputloop:
      slt $t9, $s2, $t0
      beq $t9,1,doneoutput       #if t0>last address then done

			li $v0, 4
			la $a0, endl
			syscall

			li $v0, 1
			lw $a0, 0($t0)
			syscall

			addi $t0,$t0,4
			j outputloop

	doneoutput:
      #Print empty line
      li 	$v0, 4
      la 	$a0, endl
      syscall

##########  PRINTING KTH SMALLEST NUMBER  ############################
      #Print kth smallest number
      li 	$v0, 4
      la 	$a0, msg3
      syscall

  Print1st:
    la	$t2, array		# t2 = initial address of array
    li	$t1, 0        # it will tarvel till ka nd output the kth smallest no of array the indexinhg is 0 based
    lw	$t3, k
    sub $t3,$t3,1

  forloop:
    slt $t9,$t3,$t1
    beq $t9,1,exit

    addi	$t2, $t2, 4
    addi	$t1, $t1, 1

    j	forloop
  exit:
    li 	$v0, 1
    lw 	$a0, 0($t2)
    syscall

    li 	$v0, 10 		# Terminate program run and
    syscall 			# Exit
