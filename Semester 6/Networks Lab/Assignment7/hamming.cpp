#include<iostream>
using namespace std;

int main(){
  int arr[10];
  int brr[10];
  int c,c1,c2,c3,i;

  cout<<"Enter the 4 bits of data one by one\n";
  cin>>arr[7];
  cin>>arr[6];
  cin>>arr[5];
  cin>>arr[3];

  arr[4]=arr[5]^arr[6]^arr[7];
  arr[2]=arr[3]^arr[6]^arr[7];
  arr[1]=arr[3]^arr[5]^arr[7];

  cout<<"The Encoded data is\n";
  for(i=1;i<=7;i++){
    cout<<arr[i];
  }

  cout<<"\nEnter received data bits one by one\n";
  for(i=1;i<=7;i++){
    cin>>brr[i];
  }


  c1=brr[1]^brr[3]^brr[5]^brr[7];
  c2=brr[2]^brr[3]^brr[6]^brr[7];
  c3=brr[4]^brr[5]^brr[6]^brr[7];
  c=c3*4+c2*2+c1;
  if(c==0){
    cout<<"\nThere is no error: ";
  }
  else{
    cout<<"\nError is on the postion:"<<c;
    cout<<"\nThe Correct message is:";
    if(brr[c]==0){
      brr[c]=1;
    }
    else{
      brr[c]=0;
    }

    for (i=1;i<=7;i++){
      cout<<brr[i];
    }
  }

  return 0;
}