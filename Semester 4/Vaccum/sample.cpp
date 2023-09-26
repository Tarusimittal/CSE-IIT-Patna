#include <bits/stdc++.h>
using namespace std;
#define ll long long int


double fin(int &ind,string s){
    double num=0;
    while((int)s[ind]<=57 && (int)s[ind]>=48){
        int x=s[ind]-'0';
        num=num*10 + x;
        ind++;
    }
    if(s[ind]=='.'){
        ind++;
        double div=10;
        while((int)s[ind]<=57 && (int)s[ind]>=48){
            double x=s[ind]-'0';
            num+=x/div;
            div*=(double)10;
            ind++;
        }
    }
    return (double)num;
}

void solve(string s,int &next,int &prev){
    int n=s.size();

    for(int i=0;i<n;i++){
        if(s[i]=='('){
            prev=i;
        } else if(s[i]==')'){
            next=i;
            break;
        }
    }
}

int main() {
    string s;
    cin>>s;
    int next,prev=-1;
    solve(s,next,prev);
    cout<<"Initial Circuit: "<<s<<endl;
    int cnt=1;
    while(prev!=-1){
        string ss="";
        int j=prev;
        int k=next;
        
        if(j==0)
            ss+=s.substr(0,0);
        else
            ss+=s.substr(0,j);
        
        double num=0;
        char a='*';
        
        for(++j;j<k;j++){
            if((int)s[j]<=57 && (int)s[j]>=48 && a=='*'){
                double store=fin(j,s);
                num=store;
                j--;
                
            }else if((int)s[j]<=57 && (int)s[j]>=48 && a=='+'){
                double store=fin(j,s);
                num+=store;
                j--;
    
            } else if((int)s[j]<=57 && (int)s[j]>=48 && a=='|'){
                double store=fin(j,s);
                num=(num*store)/(num+store);
                j--;
                
            } else {
                a=s[j];
            
            }   
        }

        ss+= to_string(num);
        ss+=s.substr(k+1);
        cout<<"Step "<<cnt++<<": "<<ss<<endl;
        
        s=ss;
        prev=-1;
        a='*';
        solve(s,next,prev);
    }
 
    return 0;
}