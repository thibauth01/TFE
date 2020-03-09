import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert  } from 'react-native'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { NavigationContainer } from '@react-navigation/native';
import {createAppContainer} from 'react-navigation';
import {createStackNavigator} from 'react-navigation-stack';


import SignUp from '../Component/SignUp'
import LogIn from '../Component/LogIn'
import Connexion from '../Component/Connexion'


const ListStackNavigator = createStackNavigator({


  Connexion: { // Ici j'ai appelé la vue "Test" mais on peut mettre ce que l'on veut. C'est le nom qu'on utilisera pour appeler cette vue
    screen: Connexion,
    navigationOptions: {
      title: 'Connexion',
      headerShown: false,
      
    }
  },
  LogIn: { 
    screen: LogIn,
    navigationOptions: {
      title: 'LogIn'
    },
   
  },
  SignUp: { 
    screen: SignUp,
    navigationOptions: {
      title: 'SignUp',
      headerShown: false
    }
  }

})

export default createAppContainer(ListStackNavigator)