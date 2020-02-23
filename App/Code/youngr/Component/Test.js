import React from 'react'
import { StyleSheet, View, TextInput, Text , Platform, Button, TouchableOpacity, Alert, Image  } from 'react-native'

class Test extends React.Component {

    
    render() {
      const {navigate} = this.props.navigation;
      return (

        <View>

          <Button
            title="signup"
            onPress={() => navigate('SignUp')}
          />
      
        </View>
        
  
      )
    }
  
   
  }

  export default Test