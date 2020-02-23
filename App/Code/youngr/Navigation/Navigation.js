import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert  } from 'react-native'
import {createAppContainer} from 'react-navigation';
import {createStackNavigator} from 'react-navigation-stack';
import Test from '../Component/Test'
import SignUp from '../Component/SignUp'

const ListStackNavigator = createStackNavigator({

  Test: { // Ici j'ai appelé la vue "Test" mais on peut mettre ce que l'on veut. C'est le nom qu'on utilisera pour appeler cette vue
    screen: Test,
    navigationOptions: {
      title: 'Test'
    }
  },
  SignUp: { 
    screen: SignUp,
    navigationOptions: {
      title: 'SignUp'
    }
  }

})

export default createAppContainer(ListStackNavigator)