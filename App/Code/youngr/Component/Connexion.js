import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, TouchableOpacity, Alert, Image, Dimensions  } from 'react-native'
import { Button } from 'react-native-elements'
import { LogIn } from './LogIn'
import {createAppContainer} from 'react-navigation'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { NavigationContainer } from '@react-navigation/native'
import { createStackNavigator } from 'react-navigation-stack'
import  NavigationConnexion  from '../Navigation/NavigationConnexion'




class Connexion extends React.Component {

 
  render() {
    const {navigate} = this.props.navigation;
    return (
      <View style={styles.main_container}>
        
        <View style={styles.view_image}>
          <Image style={styles.image} source={require('../Images/logo_youngr.png')} />
        </View>
    
        <View style={styles.view_buttons}>
          <View styles={styles.view_button_logIn}>
            <Button
              type="clear"
              buttonStyle={styles.button_style}
              titleStyle={styles.title_button_style_logIn}
              title="Log In"
              onPress={() => navigate('LogIn')}
              />
          </View>
          <View styles={styles.view_button_signUp}>
            <Button
              type="clear"
              titleStyle={styles.title_button_style_signUp}
              buttonStyle={styles.button_style}
              title="Sign Up"
              onPress={() => navigate('SignUp')}
            />
          </View>
        </View>
      

      </View>
    )
  }
}

const styles = StyleSheet.create({
   
  main_container: {
    flex: 1,
    backgroundColor:"#334856",
    fontFamily:"roboto-light",
    justifyContent:"center",
    alignItems:"center"
  },

  

  /*Body*/
  body_container:{
    

  },
  view_image:{
    flex:3,
    justifyContent:"center"
    
  },
  image:{
    width:Dimensions.get("window").width,
    height:100,
    
  },
 
  view_buttons:{
    width:Dimensions.get("window").width,
    flex:1,
    flexDirection:'row',
    justifyContent:"space-around",
    alignItems:"center",
    
  },
  view_button_logIn:{
    

  },
  view_button_signUp:{
    

  },

  button_style:{
    width:150,
    height:70,
  },
  title_button_style_logIn:{
    color:'white',
    fontSize:20
  },
  title_button_style_signUp:{
    color:'#D97D54',
    fontSize:20
  }

})

export default Connexion