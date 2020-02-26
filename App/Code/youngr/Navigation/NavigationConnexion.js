import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert  } from 'react-native'
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs'
import { NavigationContainer } from '@react-navigation/native';
import SignUp from '../Component/SignUp'
import LogIn from '../Component/LogIn'


const Tab = createMaterialTopTabNavigator();

function NavigationConnexion() {
  return (
    <NavigationContainer>
      <Tab.Navigator
      initialRouteName="Feed"
      swipeEnabled="false"
      tabBarOptions={{
        indicatorStyle  :{backgroundColor: "#D97D54"},
        activeTintColor: 'white',
        pressColor: '#273640',
        upperCaseLabel :false,
        labelStyle: { fontSize: 13 },
        style: { backgroundColor: '#334856' },
      }}>
        <Tab.Screen name="Sign Up" component={SignUp} />
        <Tab.Screen name="Log In" component={LogIn} />
      </Tab.Navigator>
    </NavigationContainer>
  );
}
//creer ici la vue createMaterialTopTabNavigator

export default NavigationConnexion