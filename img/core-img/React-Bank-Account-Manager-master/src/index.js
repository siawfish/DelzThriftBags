import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import * as serviceWorker from './serviceWorker';
import { createStore, applyMiddleware, compose} from 'redux';
import { Provider } from 'react-redux';
import reducer from './redux/reducer';
import firebase from './config'
import thunk from 'redux-thunk'
import { reduxFirestore, getFirestore } from 'redux-firestore';

let store = createStore(reducer, 
    compose(
    applyMiddleware(thunk.withExtraArgument(getFirestore)),
    reduxFirestore(firebase)
    )
)


ReactDOM.render(<Provider store={store}><App /></Provider>, document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
