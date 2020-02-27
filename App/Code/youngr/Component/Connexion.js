import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert, Image  } from 'react-native'
import { LogIn } from './LogIn'
import {createAppContainer} from 'react-navigation'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { NavigationContainer } from '@react-navigation/native'
import { createStackNavigator } from 'react-navigation-stack'
import  NavigationConnexion  from '../Navigation/NavigationConnexion'


const Tab = createMaterialTopTabNavigator();


class Connexion extends React.Component {

  constructor(props) {
     super(props)
     this.state = {
      
    }
   }


  render() {
    return (
      <View style={styles.main_container}>

        <View style={styles.header_container}>

          <View style={styles.logo_view}>
            <Image style={styles.logo_img} source={require('../Images/logo_youngr.png')}/>
          </View>

        </View>

        <View style={styles.body_container}>
          <NavigationConnexion/>
        </View>

      </View>
    )
  }
}

const styles = StyleSheet.create({
   
  main_container: {
    flex: 1,
    backgroundColor:"#334856",
    fontFamily:"roboto-light"
  },

  /*Header*/
  header_container:{
    flex:2,
    backgroundColor:"#334856"

  },
  logo_view:{
    justifyContent:"center",
    alignItems:"center",
    height:250,
  },
  logo_img:{
    height:100,
    width:250
    
  },

  

  /*Body*/
  body_container:{
    backgroundColor:"#273640",
    flex:6

  }
})

export default Connexion