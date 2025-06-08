import API from "../api"; // Assuming 'api' is configured with axios.create()

export const login = async ({ email, password }) => {
  try {
    const { data } = await API.post("/login", { email, password });
    return data;
  } catch (err) {
    console.error("Login failed:", err); // Use console.error for errors
    throw err;
  }
};

export const register = async ({ name, email, password }) => {
  try {
    // Send name, email, and password in the request body
    const { data } = await API.post("/register", { name, email, password });
    return data; // Return data if registration is successful
  } catch (err) {
    console.error("Registration failed:", err); // Use console.error for errors
    throw err;
  }
};

export const logout = () => {
  try {
    localStorage.removeItem("accessToken");
    localStorage.removeItem("userInfo");
    // Optionally, you might want to redirect the user after logout
    // import { useNavigate } from 'react-router-dom';
    // const navigate = useNavigate();
    // navigate('/login');
  } catch (err) {
    console.error("Logout failed:", err); // Use console.error for errors
    throw err;
  }
};
