import React from 'react'
import { StyleSheet } from 'react-native'
import {Button,Text, Block, Input,Icon} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import NetInfo from '@react-native-community/netinfo'


import MyAccountWorker from './MyAccountWorker';
import MyAccountRequester from './MyAccountRequester';

function  Offline() {
  return (
    <Block flex={1} middle row>
      <Icon  size={40} name="wifi-off" family="feather"/>
      <Text h5 style={{marginLeft:15}}>Aucune connexion internet</Text>
    </Block>
  );
}

class MyAccount extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      isConnected: false
    }
  }

  componentWillUnmount() {
    NetInfo.removeEventListener(this.handleConnectivityChange);
  }

  componentDidMount(){
    NetInfo.addEventListener(this.handleConnectivityChange);
  }

  handleConnectivityChange = state => {
    if (state.isConnected) {
      this.setState({isConnected: true});
    } else {
      this.setState({isConnected: false});
    }
  };

  accountType = () => {
    if (!this.state.isConnected) {
      return <Offline />;
    }
    else{

      if(this.props.account.type == "requester"){
        return <MyAccountRequester navigate = {this.props.navigation}/>
      }
      else if(this.props.account.type == "worker"){
          return <MyAccountWorker navigate =  {this.props.navigation}/>
      }
      else{
          return <Text>hello</Text>
      }
    }

    
}


  render() {
    
    
    return (
        <Block   style={styles.main_container}>
          {this.accountType()}
        </Block>
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND,
    
  }
})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(MyAccount)