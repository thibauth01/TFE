import React from 'react'
import {Image,StyleSheet } from 'react-native'

import {createAppContainer} from 'react-navigation';
import {createStackNavigator} from 'react-navigation-stack';
import { createBottomTabNavigator } from 'react-navigation-tabs';
import { Icon } from 'galio-framework';


import Login from '../Component/Login';
import Dashboard from '../Component/Dashboard';
import Message from '../Component/Message';
import Works from '../Component/Works';
import DetailsWorksFree from '../Component/DetailsWorksFree';
import DetailsWorksTodo from '../Component/DetailsWorksTodo';



const bottomNavigator = createBottomTabNavigator({
  Dashboard: { 
    screen: Dashboard,
    navigationOptions: {
      title: 'Dashboard ',
      tabBarIcon: () => { // On définit le rendu de nos icônes par les images récemment ajoutés au projet
        return <Image
          source={require('../Images/dashboard.png')}
          style={styles.icon}/> // On applique un style pour les redimensionner comme il faut
      }
      
    }
  },
  Works: { 
    screen: Works,
    navigationOptions: {
      title: 'Travaux',
      headerShown: false,
      tabBarIcon: () => { // On définit le rendu de nos icônes par les images récemment ajoutés au projet
        return <Image
          source={require('../Images/repair.png')}
          style={styles.icon}/> // On applique un style pour les redimensionner comme il faut
      }
      
    }
  },
  Message: { 
    screen: Message,
    navigationOptions: {
      title: 'Messages',
      headerShown: false,
      tabBarIcon: () => { // On définit le rendu de nos icônes par les images récemment ajoutés au projet
        return <Image
          source={require('../Images/comment.png')}
          style={styles.icon}/> // On applique un style pour les redimensionner comme il faut
      }
    }
  }
},
  {
    tabBarOptions: {
      activeBackgroundColor: '#ebecf1', // Couleur d'arrière-plan de l'onglet sélectionné
      inactiveBackgroundColor: '#FFFFFF', // Couleur d'arrière-plan des onglets non sélectionnés
      showLabel: false, // On masque les titres
      showIcon: true, // On informe le TabNavigator qu'on souhaite afficher les icônes définis
      style: {
        borderWidth: 0,
      },
    }
  }
)

const ListStackNavigator = createStackNavigator({


  Login: { 
    screen: Login,
    navigationOptions: {
      title: 'Connexion ',
      headerShown: false,
      
    }
  },
  Main: { 
    screen: bottomNavigator,
    navigationOptions: {
      title: 'Main ',
      headerShown: false,
      
    }
  },
  DetailsWorksFree:{
    screen: DetailsWorksFree,
    navigationOptions: {
      title: 'Détails'
      
    }
  },
  DetailsWorksTodo:{
    screen:DetailsWorksTodo,
    navigationOptions: {
      title: 'Détails'
      
    }
  }

})

const styles = StyleSheet.create({
  icon: {
    width: 22,
    height: 22
  }
}) 

export default createAppContainer(ListStackNavigator)