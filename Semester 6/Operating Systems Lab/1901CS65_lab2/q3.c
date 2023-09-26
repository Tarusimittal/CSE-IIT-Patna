#include <stdio.h>

// Function to find and print xor of two numbers
void xor(long long a, long long b) {
    long long res = 0, pw = 1;
    // Keep reducing while keeping track of XOR of bits
    // Add result into res
    while (a != 0 || b != 0) {
        int xr = (a % 2) * !(b % 2) + !(a % 2) * (b % 2);
        res += xr * pw;
        a /= 2;
        b /= 2;
        pw *= 2;
    }
    printf("XOR Value = %lld\n", res);
}

// Main function
int main(int argc, char* argv[]) {
    // Argument count should be 3 exactly
    if (argc != 3) printf("Error: Please enter 2 integers as arguments.");
    else {
        // Scan inputs from arguments
        long long a, b;
        sscanf(argv[1], "%lld", &a);
        sscanf(argv[2], "%lld", &b);
        // Find and print XOR
        xor(a, b);
    }
}