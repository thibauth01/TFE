import {createStore, combineReducers} from 'redux'
import account from './Reducers/LoginReducer'

export default createStore(combineReducers({account}));