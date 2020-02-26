import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Connexion from './Component/Connexion'

export default function App() {
  return (
    <View style={styles.container}>
      <Connexion/>    
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    
    
  },
});
