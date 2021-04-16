import React, { useState } from 'react';

const NameForm = () => {
    const [medicare_num, setMedicareNumber] = useState('');
    const [first_name, setFirstName] = useState('');
    const [last_name, setLastName] = useState('');
    const [phone_num , setPhoneNumber] = useState('');
    const [dob, setDOB] = useState('');
    const [citizenship, setCitizenship] = useState('');
    const [email, setEmail] = useState('');

    const handleSubmit = () => {
        let Person = {
            first_name, 
            last_name,
            phone_num,
            dob,
            citizenship,
            email,
            medicare_num
        }
        alert('A form was submitted: ' + Person);
        console.log('A form was submitted: ' + Person);
        const response = fetch('../../api/server.php/test', {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
              'Content-Type': 'application/json'
              // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: JSON.stringify(Person) // body data type must match "Content-Type" header
            });
        console.log("Post response", response)    
    }
      return (
        <form  onSubmit={handleSubmit}>
          <label>
            First Name:
            <input type="text" value={first_name} onChange={(event) => setFirstName(event.target.value)} />
          </label>
          <label>
            Last Name:
            <input type="text" value={last_name} onChange={(event) => setLastName(event.target.value)} />
          </label>
          <label>
            Phone:
            <input type="text" value={phone_num} onChange={(event) => setPhoneNumber(event.target.value)} />
          </label>
          <label>
            DOB:
            <input type="text" value={dob} onChange={(event) => setDOB(event.target.value)} />
          </label>
          <label>
            Citizenship:
            <input type="text" value={citizenship} onChange={(event) => setCitizenship(event.target.value)} />
          </label>
          <label>
            Email:
            <input type="text" value={email} onChange={(event) => setEmail(event.target.value)} />
          </label>
          <label>
            Medicare Name:
            <input type="text" value={medicare_num} onChange={(event) => setMedicareNumber(event.target.value)} />
          </label>
          <input type="submit" value="Submit" />
        </form>
      );
  }


  export default NameForm;