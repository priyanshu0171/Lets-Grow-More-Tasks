import React, { useState, useEffect } from "react";
import * as ReactBootstrap from "react-bootstrap";

const App = () => {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(false);
  const loadUsers = async () => {
    const response = await fetch("https://reqres.in/api/users?page=1");
    const responseJson = await response.json();
    setUsers(responseJson.data);
    if (responseJson.data) {
      setLoading(false);
    }
  };
  function simulateNetworkRequest() {
    return new Promise((resolve) => setTimeout(resolve, 2000));
  }

  const handleClick = () => setLoading(true);

  useEffect(() => {
    if (loading) {
      simulateNetworkRequest().then(() => {
        setLoading(false);
        loadUsers();
      });
    }
  }, [loading]);

  return (
    <div>
      {/* Navbar start */}
      <nav className="navbar navbar-expand-lg navbar-light bg-dark">
        <div className="container">
          <a className="navbar-brand text-white" href="/">
            GetThatUser
          </a>
          <ul className="navbar-nav ms-auto mb-2 mb-lg-0">
            <li className="nav-item">
              <button className="btn btn-sm btn-light" onClick={!loading ? handleClick : null}>
                Get Users
              </button>
            </li>
          </ul>
        </div>
      </nav>
      <div className="container">
        <div className="row">
          {loading ? (
            <div className="container my-5 pt-5 text-center">
              {<ReactBootstrap.Spinner animation="border" />}
              <small>
                <br />
                Loading...
              </small>
              <br />
              <h3 className="text-uppercase">Fetching Data</h3>
            </div>
          ) : (
            users.map(({ id, avatar, first_name, last_name, email }) => (
              <div className="col-md-4 mt-5 text-center mx-auto" key={id}>
                <div
                  className="card py-3 bg-dark"
                  style={{
                    boxShadow: "2px 2px 20px #ccc",
                    borderRadius: "10px",
                  }}
                >
                  <div className="card-body px-2 row">
                    <div className="col-4">
                      <img
                        src={avatar}
                        alt="UserImage"
                        style={{ borderRadius: "100%" }}
                      />
                    </div>
                    <div className="col-8">
                      <h3 className="text-white">
                        {first_name} {last_name}
                      </h3>
                      <h6 className="text-white">User Id: {id}</h6>
                      <p className="text-muted">Email: {email}</p>
                    </div>
                  </div>
                </div>
              </div>
            ))
          )}
        </div>
      </div>
      <footer className=" mt-5 py-2 bg-dark text-white text-center text-uppercase">
        Task 2 completed by - Priyanshu Mishra | Letsgrowmore | VIP
      </footer>
    </div>
  );
};
export default App;
