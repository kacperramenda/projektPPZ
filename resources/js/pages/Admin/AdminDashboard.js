const AdminDashboard = () => {
    return (
      <div className="admin-panel">
        <h1>Admin Dashboard</h1>
        <div className="admin-content">
          <div className="stats-card">
            <h3>Quick Stats</h3>
            <p>Users: 150</p>
            <p>Active Sessions: 23</p>
          </div>
          <div className="actions-panel">
            <button className="admin-btn">Manage Users</button>
            <button className="admin-btn">View Logs</button>
            <button className="admin-btn">System Settings</button>
          </div>
        </div>
      </div>
    );
  }
  
  export default AdminDashboard;