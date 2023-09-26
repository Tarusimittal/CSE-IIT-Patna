//Tarusi Mittal
//1901cs65
//We are only giving valid inputs of maximum weight which are possible
//When we are calculating the row for maximum weight given we are writing the total rows present


#include<stdio.h>
#include<math.h>

//funtion to calculate the weight at each index
float calculateWeight(float n,float m){
    // declaring a variable to store
    float temp;
    if(n==0){
        //base case
        return 0;
    }
    // if the given index is not the edge case
    if(m!=n && m!=0){
       temp=200+calculateWeight(n-1,m)/2+calculateWeight(n-1,m-1)/2;
       return temp;
    }
    //If the given index is first element of the row
    if(m==0){
        temp=100+calculateWeight(n-1,m)/2;
        return temp;
    }
    //if given index is last element of row
    temp=100+calculateWeight(n-1,m-1)/2;
    return temp;


}
// function to calcuate row for corresponding maximum weight
float calculateRow(float weight,float ans,int n){
    if(weight <= ans){
        //base case
       return n;
    }
    else{
        // to check for each row
        ans=calculateWeight(n,n/2);
        calculateRow(weight, ans, n+1);
    }
}

int main(){
    printf("If u want to calculate the weight enter 1\nIf you want to calculate the no of rows enter 2 \n");
    int value;
    scanf("%d",&value);
    if(value==1){
        // if we have to finf the weight
        float n,m;
        printf("Enter Row No: \n");
        scanf("%f",&n);
        printf("Enter Column No: \n");
        scanf("%f",&m);
        float s=calculateWeight(n,m);
        printf("for desired given inputs the weight is %f\n",s);
            for(int i=0;i<=n;i++){
                for(int j=0;j<=i;j++ ){
                   float ans=calculateWeight(i,j);
                   printf("Weight for index %d %d is: ",i,j);
                   printf("%f\n",ans);
                }
            }


    }
    else{
        // if we have to find the row
        printf("Enter the maximum weight carrying capacity: ");
        float weight;
        scanf("%f",&weight);
        int final=calculateRow(weight, 0, 0);
        printf("%d",final);
    }


    return 0;
}
