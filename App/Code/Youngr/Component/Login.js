import React from 'react'
import { ActivityIndicator,StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking,Keyboard } from 'react-native'
import {Button,Text, Block, Input} from 'galio-framework'
import { theme } from '../Constants'
import { connect } from 'react-redux'
import { NavigationEvents } from 'react-navigation';
import {Toast} from 'native-base'



class Login extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
        user:"",
        password:"",
        account:undefined,
        loading:false
    }
  }
    
    componentWillMount(){
        this.setState({
            loading:false
        })

        if(this.props.navigation.state.params != undefined){

            const action = { type: "LOGOUT_ACCOUNT", value: undefined}
            this.props.dispatch(action)

        }
        else{
            if(this.props.account != undefined){
                if(this.props.account.id != undefined){
                    this.props.navigation.navigate("Dashboard")
                }
            }
            
        }
        
    }

    login = () =>{
        const {user,password} = this.state;
        this.setState({
            loading:true
        })
        
        if(user==""){
            this.setState({
                loading:false
            })
            Toast.show({
                text: "Utilisateur manquant",
                duration: 2000,
                type:"danger"
            })
        }

        else if(password==""){
            this.setState({
                loading:false
            })
            Toast.show({
                text: "Mot de passe manquant",
                duration: 2000,
                type:"danger"
            })
        }
        
        else{
        
        fetch('https://dashboard.youngr.be/api/login.php',{
            method:'POST',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                user: user,
                password: password
            })
            
        })
        .then((response) => response.json())
            .then((responseJson)=>{
                if(responseJson.status){
                    
                    this.setState({
                        account:responseJson.data,
                    })
                    const action = { type: "GET_ACCOUNT", value: this.state.account}
                    this.props.dispatch(action)
                    
                    this.setState({
                        user: "",
                        password: ""
                    })

                    this.props.navigation.navigate("Dashboard")
                
                }
                else{
                    this.setState({
                        loading:false
                    })
                    Toast.show({
                        text: responseJson.txt,
                        duration: 2000,
                        type:"danger"
                    })
                }
            })
            .catch((error)=>{
                this.setState({
                    loading:false
                })
                console.error(error);
            });
        }
        
        
        Keyboard.dismiss();
    }
    
    isLoading(){
        if(this.state.loading){
            return(
                <Button
                    radius={10}
                    size={300}
                    color={theme.COLORS.SECONDARY}
                    onPress={this.login}
                >
                    <ActivityIndicator/>
                </Button>
                
            )
        }
        else{
            return(
                <Button
                    radius={10}
                    size={300}
                    color={theme.COLORS.SECONDARY}
                    onPress={this.login}
                >
                    Connexion
                </Button>
            )
        }
    }

  render() {  
    const {navigate} = this.props.navigation;
    return (
      <Block   style={styles.main_container}>
          <NavigationEvents
                onDidFocus={() => this.componentWillMount()}
            />
          <Block middle flex={0.5}>
            <Image 
                    style={styles.logo}
                    source={require(`../Images/logo.png`)}
                />
          </Block>
          <Block center style={styles.block_login}>
            <Block  space="evenly" flex={2.5}>
                <Block middle width={250} >
                    <Input 
                        style={styles.input}
                        placeholder="Nom d'utilisateur" 
                        right
                        borderless
                        icon="user"
                        family="antdesign"
                        iconColor={theme.COLORS.SECONDARY}
                        onChangeText={user => this.setState({user})}
                        value={this.state.user}
                    />
                </Block>
                <Block  width={250}>
                    <Input 
                        style={styles.input}
                        placeholder="Mot de passe" 
                        borderless
                        right
                        password
                        viewPass
                        onChangeText={password => this.setState({password})}
                        value={this.state.password}
                    />
                </Block>
            </Block>
            <Block middle flex={2}>
                {this.isLoading()}
                
            </Block>
            <Block middle flex={1}>
                <Text>Pas encore de compte ?</Text><Text color={theme.COLORS.SECONDARY} onPress={ ()=> Linking.openURL('https://dashboard.youngr.be/connexion.php') }>Inscris toi !</Text>
            </Block>
          </Block>
      </Block>
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND
    
  },
  titleH2:{
      paddingTop:15
  },
  logo:{
    width:230,
    height:90
  },

  block_login:{
    paddingTop:20,
    backgroundColor:theme.COLORS.DEFAULT,
    height:350,
    width:300,
    borderRadius:15,
    shadowColor: "#000",
    shadowOffset: {
        width: 0,
        height: 1,
    },
    shadowOpacity: 0.20,
    shadowRadius: 1.41,

    elevation: 2,
        
        
    },

    input:{
        height:55,
        paddingLeft:20,
        shadowColor: "#000",
        shadowOffset: {
            width: 0,
            height: 1,
        },
        shadowOpacity: 0.20,
        shadowRadius: 1.41,

        elevation: 2,
    },


 

})

const mapStateToProps = (state) =>{
    return {
        account: state.account.account,
       
    }
}

export default connect(mapStateToProps)(Login)