import React, {useState} from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Nav from './Navigation/NavigationConnexion'

import * as Font from 'expo-font';
import { AppLoading } from 'expo';

const fetchFonts = () => {
  return Font.loadAsync({
  'roboto-light': require('./assets/fonts/Roboto-Light.ttf'),
  
  });
  };

export default function App() {
  const [dataLoaded, setDataLoaded]  = useState(false);

  if(!dataLoaded){
    return(
      <AppLoading
        startAsync={fetchFonts}
        onFinish={()=> setDataLoaded(true)}
      />
    )
  }

  return (
    <View style={styles.container}>
      <Nav/>    
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    
    
  },
});
