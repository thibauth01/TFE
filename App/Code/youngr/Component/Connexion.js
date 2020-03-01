import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert, Image, Dimensions  } from 'react-native'
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
        
        <View style={styles.body_container}>
          <Image style={styles.image} source={require('../Images/logo_youngr.png')} />
        </View>
        <Button
            title="LogIn"
            onPress={() => navigate('LogIn')}
          />
        <Button
          title="Sign Up"
          onPress={() => navigate('SignUp')}
        />

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
  image:{
    width:Dimensions.get("window").width,
    height:100,
  }

})

export default Connexion