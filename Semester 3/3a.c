//Tarusi Mittal
//1901Cs65
// ASSUMPION: n cannot be greater than 1000000
#include<stdio.h>
#include<math.h>

void createbrr(int nr, int ind , char arr[], int n, int brr[]){
    if(ind==n){
        //base condition
        return;
    }
    if(arr[ind]=='R'){
        nr++;
    }
    // storing no of r to the left of each index
    brr[ind]=nr;
    createbrr(nr,ind+1,arr,n,brr);
 }
int findans(int cans,int n, int ind, char arr[], int brr[]){
    if(ind==n){
        //base condition
        return cans;
    }
    if(arr[ind]=='W'){
        //recursive function to increment the ans at each step
        return findans(cans+brr[ind],n,ind+1,arr,brr);
    }
    return findans(cans, n, ind+1, arr, brr);
}

int main(){
    //taking input
    int n;
    scanf("%d",&n);
    char arr[1000000];
    int brr[1000000]={};
    for(int i=0;i<n;i++){
        char a;
        scanf(" %c", &a);
        arr[i]=a;
    }
    //making an array brr to store the no of R to the left of any index
    createbrr(0, 0, arr, n, brr);
    //final ans to calculate the number of pairs that can be made
    int ans=findans(0,n,0,arr,brr);
    printf("%d",ans);
    return 0;
}

//run Time of the function is of the order O(n)
// the two function are using linear time and
//hence the complexity will remain of the order
//O(n);
//first we are taking the input of the array
// then in one function we are creating another array in which we will store the no of R to the left of any index
// in the next function we will recursively call the function and update the no of pairs
// that are formed upto the given given index
// t(n)=O(n)
