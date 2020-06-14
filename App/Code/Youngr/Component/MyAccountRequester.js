import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card,Icon} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import { NavigationEvents } from 'react-navigation';
import Theme from '../Constants/Theme';


class MyAccountRequester extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      workDone:undefined,
      path:undefined
    }
  }

  componentDidMount(){
    this.getData().then(response => this.setState({
      workDone: response.workDone,
      path:response.path
    })); 
  }

  getData(){
    return fetch('https://dashboard.youngr.be/api/infosAccount.php',{
      method:'POST',
      header:{
        'Accept': 'application/json',
        'Content-type': 'application/json'
      },
      body:JSON.stringify({
        type: this.props.account.type,
        idAccount: this.props.account.id,
        idTypeAccount: this.props.account.idTypeAccount,
        jwt: this.props.account.jwt
      })
      
    })
    .then((response) => response.json())
     .then((responseJson)=>{
       console.log(responseJson);
      return responseJson;
       
     })
     .catch((error)=>{
     console.error(error);
     });

     
  }

  statut(){
    if(this.props.account.type == "worker"){
      return (
        <Text h5 style={{marginTop:20}} color={Theme.COLORS.SECONDARY}>Travailleur</Text>
      )
    }
    else if(this.props.account.type == "requester"){
      return(
        <Text h5 style={{marginTop:20}} color={Theme.COLORS.SECONDARY}>Demandeur</Text>

      )

    }
    else{
      return(
        <Text h5 style={{marginTop:20}} color={Theme.COLORS.SECONDARY}>Pas de statut</Text>

      )

    }
  }

  logout=()=>{
    
    this.props.navigate.navigate('Login',{logout:true});
  }
 


  render() {
  const {navigate} = this.props.navigate;
  const path = `https://dashboard.youngr.be/`+this.state.path;
  

    return (
        <Block  style={styles.main_container}> 
          <NavigationEvents
                  onDidFocus={() => this.componentDidMount()}
          />
          <Block  flex={1}>
            <Block flex={3} middle >
              <Image style={styles.profile} source={{uri:path}}></Image>
              <Text h4 style={{marginTop:30}}>{this.props.account.first_name} {this.props.account.last_name}</Text>
              <Text color={Theme.COLORS.MUTED} h6 style={{marginTop:3}}>{this.props.account.username}</Text>
              {this.statut()}
             

            </Block>
            <Block flex={1.5} style={{marginLeft:70}} >
              <Block row >
                  <Icon size={28} name="award" family="feather" color={theme.COLORS.MUTED}/>
                  <Text style={styles.textContent}>{this.state.workDone} Travaux terminés</Text>
              </Block>
            </Block>
            <Block flex={0.5} center>
              <Button style={styles.buttonDelete} onPress={()=>this.logout()} >Déconnexion</Button>
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
  profile:{
    borderRadius:150,
    height:150,
    width:150
  },
  textContent:{
    fontSize:20,
    marginLeft:15
  },
  buttonDelete:{
    backgroundColor:theme.COLORS.SECONDARY,
    width:200,
    height:40,
  },

})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(MyAccountRequester)