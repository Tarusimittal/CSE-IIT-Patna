//Tarusi Mittal
//1901Cs65
#include<stdio.h>
#include<stdlib.h>

void longestsequence( int arr[], int n ){  
    //an array to store the maximum longest sequence upto that element
    int storedata[n]; 
    //an array to store th eindex of the previous element from where the longest sequence is continued
    int index[n];
    //initialising the first as the lonegst sequence minimum length is always one
    storedata[0] = 1;
    //running a nested loop to create the store data array
    for (int i = 1; i < n; i++ ){ 
        //in first loop initialising each element to one because it is th eminimum length
        storedata[i] = 1; 
        for (int j = 0; j < i; j++ ) 
        //checking the conditions
        //1. absolute value should be larger
        //2. the product should be less that 0 as we want alternative sequences
        //3. the value of list will be updated only if it is getting increased
            if ( abs(arr[i]) > abs(arr[j]) && arr[i]*arr[j]<0 && storedata[i] < storedata[j] + 1){  
                storedata[i] = storedata[j] + 1; 
                //storing the index so that it can be used to print the required sequence
                index[i]=j;
            }
    } 
    // initialising an integer to store the index of the last element of the required sequence
    int q;
    int max=storedata[0];
    // finding the max element in the array created which will be th eno of elemnets in the sub sequence
    for(int i=0;i<n;i++){
       if(storedata[i]>max){
           max=storedata[i];
           q=i;
       }
    }
    // initialising an array so that to print the required array
    int brr[max];
    int p=max;
    // storing values in the array in the revrse manner
    for(int i=0;i<p;i++){
        brr[i]=arr[q];
        q=index[q];
    }
    //printing the array with required elements
    for(int j=max-1;j>=0;j--){
        printf("%d ",brr[j]);
    }
    // printing the length of the subsequence
    printf("\n%d",max);
}  

int main(){ 
    int n;
    //taking the input if no of elements
    scanf("%d",&n);
    int arr[n];
    //taking input of array
    for(int i=0;i<n;i++){
        int a;
        scanf("%d",&a);
        arr[i]=a;
    }
    //pasing them througth the function
    longestsequence( arr, n );
    return 0; 
}