import React, {useState} from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Nav from './Navigation/Navigation'
import {Provider} from 'react-redux'
import Store from './Store/configureStore'

export default function App() {
  
  return (
    <Provider store={Store}>
      <Nav/>
    </Provider>
          
  );
}

const styles = StyleSheet.create({
  
});
