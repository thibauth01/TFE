import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Nav from './Navigation/Navigation'

export default function App() {
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
