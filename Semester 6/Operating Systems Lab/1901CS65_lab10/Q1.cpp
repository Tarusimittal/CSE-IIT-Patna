#include<bits/stdc++.h>
using namespace std;

map <int,int> pageFrame;  // to map
vector <int> v;           // to keep teh count of blocked frames
vector <int> use_frame;  //to keep the count of used frmaes
//int totalFrames[5000];
int p,s,f,n,q;
int divi;
int page =0;

void allocation(int a);
void translation(int a);
void deletion(int a);

int main(){
	//take all teh inputs
  cin>>p>>s>>f>>n>>q;
  int arr[2*n];
  for(int i=0;i<2*n;i++){
    cin>>arr[i];
  }
  
  //used later to find teh number of frames
  divi = pow(2, f);
  
  //pushing the frame numbers in the array which are occupied
  for(int i=0;i<2*n;i+=2){
  	for(int j=arr[i];j<=arr[i+1];j++){
  		v.push_back(j);
  	}
  }
  
  //used to store queries
  char crr[q];
  int nrr[q];
  for(int i=0;i<q;i++){
    cin>>crr[i]>>nrr[i];
  }
  
  
  for(int i=0;i<q;i++){
  	
    //for allocation
    if(crr[i]=='a'){
    	
    	allocation(nrr[i]);
    	
		
    }
    //for translation
    else if(crr[i]=='t'){
    	translation(nrr[i]);

    }
    //for deletion
    else if(crr[i]=='d'){
    	deletion(nrr[i]);
    }
    //if input format is wrong
    else{
      printf("Error in inputing of this query\n");
    }
  }

}

void allocation(int a){
	
	// a vector to store the frame no used
	vector <int> temp;
	int framesReq = a/divi;
	int h= p-f;
	
	// limit of mac=ximum no of frames that can be used
	int maxFrame= pow(2,h);
	
	// we iterate in a for loop
	// and at each iteration we check the lowest frame empty
	// and we allot our page that frame number
	for(int i=0;i<maxFrame;i++){
		auto it = find(use_frame.begin(),use_frame.end(),i);
		if(it!=use_frame.end()){
			continue;
		}
		else{
			auto iit = find(v.begin(),v.end(),i);
			if(iit!=v.end()){
				continue;
			}
			else{
				pageFrame[page]=i;
				page++;
				use_frame.push_back(i);
				framesReq--;
				temp.push_back(i);
			}
		}
		
		// if at any point we have alloted teh required frames 
		//we come out of teh loop
		if(framesReq==0){
			break;
		}
	}
	
	
	if(framesReq!=0){
		printf("Frames not available\n");
	}
	else{
		printf("%d bytes has been allocated in frame no:",a);
		for(int i=0;i<temp.size();i++){
			printf("%d ",temp[i]);
		}
		printf("\n");
	}
	//at last we clear out temporary array 
	// so that it does not store teh results from 
	//previous run in the next run
	temp.clear();
	
}

//
void translation(int a){
	int binaryN[32]={};
	int cnt =0;
	while(a>0){
		//store remainder in an binary array
		binaryN[cnt]= a%2;
		a/=2;
		cnt++;
	}
	long long int temp = 0;
	
	//print binary array in reverse ordwr
	for(int i=cnt-1;i>=f;i--){
		if(binaryN[i]){
			temp+=pow(2,i-f);
			binaryN[i]=0;
		}
	}
	if(pageFrame.find(temp)==pageFrame.end()){
		printf("Invalid page number\n");
		return;
	}
	else{
		long long int flag=pageFrame[temp];
		long long int flag2 = f;
		while(flag >0){
			binaryN[flag2]=flag%2;
			flag /=2;
			flag2++;
		}
		int ans=0;
		for(int i=flag2-1;i>=0;i--){
			if(binaryN[i]){
				ans+=pow(2,i);
			}
		}
		printf("The physical address is:%d\n",ans);
	}
	
	
}

//for deleetion
void deletion(int a){
	int temp =a;
	
	//we check if that page no is used
	if(pageFrame.find(a)!=pageFrame.end()){
	int del = pageFrame[a];
	
	pageFrame.erase(a);
	auto it = find(use_frame.begin(),use_frame.end(),del);
	//if yes we deleted it
	if(it!=use_frame.end()){
		use_frame.erase(it);
		printf("Page number %d has been deleted and frame %d is now empty\n",a,del);
	}
	//if no then our inout is invaliud
	else{
		printf("Invalid Input/n");
		return;
	}
	}
	else{
		printf("Invalid Page no Input/n");
		return;
	}
	
}