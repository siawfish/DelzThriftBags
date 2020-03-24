import React, { Component } from 'react'
import { connect } from 'react-redux'
import { addNewAccount } from './redux/actions'
export class AddAccount extends Component {

    handleOnSubmit = (event)=>{
        event.preventDefault();
        let newAccount = {
            accountName: event.target.elements.accountName.value,
            accountNumber: event.target.elements.accountNumber.value,
            bankName: event.target.elements.bankName.value,
            bankBranch: event.target.elements.bankBranch.value,
        }
        this.props.addNewAccount(newAccount)
        this.props.history.push("/")
    }
    render() {
        return (
            <div>
                <h1>Add Account</h1>
               <form onSubmit={this.handleOnSubmit}>
                   <div>
                       <label>Account Name</label>
                       <input type="text" name="accountName"/>
                   </div>

                   <div>
                   <label>Account Number</label>
                       <input type="number" name="accountNumber"/>
                   </div>

                   <div>
                        <label>Bank Name</label>
                       <input type="text" name="bankName"/>
                   </div>

                   <div>
                        <label>Bank Branch</label>
                       <input type="text" name="bankBranch"/>
                   </div>

                   <div>
                       <button type="submit">Add Account</button>
                   </div>
                </form> 
            </div>
        )
    }
}

const mapDispatchToProps = {
    addNewAccount
}



export default connect(null, mapDispatchToProps)(AddAccount)