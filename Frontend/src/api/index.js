import axios from "axios";

const API = axios.create({
  baseURL: "https://akmal-bc.karyakreasi.id/api",
});

export default API;
