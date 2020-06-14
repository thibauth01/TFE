import React, {useState} from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Nav from './Navigation/Navigation'
import { PersistGate } from 'redux-persist/es/integration/react'
import { Provider } from 'react-redux'
import Store from './Store/configureStore'
import { persistStore } from 'redux-persist'
import { Root } from "native-base";

export default function App() {
  let persistor = persistStore(Store)
  return (
    <Provider store={Store}>
      <PersistGate persistor={persistor}>
        <Root>
          <Nav/>
        </Root>
      </PersistGate>
    </Provider>
          
  );
}


