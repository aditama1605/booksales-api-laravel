import { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { login } from "../../services/auth"; // Ini yang benar

export default function Login() {
  // state (email, password)
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const navigate = useNavigate(); // Fungsi navigate dari React Router DOM

  // Fungsi handle untuk input email dan password
  const handleEmail = (e) => {
    setEmail(e.target.value);
  };

  const handlePassword = (e) => {
    setPassword(e.target.value);
  };

  // Fungsi untuk menangani pengiriman form login
  const handleSubmit = async (e) => {
    e.preventDefault(); // Mencegah refresh halaman default form

    try {
      // Koneksi ke service auth untuk login
      const res = await login({ email, password });

      // Cek peran (role) pengguna dan arahkan ke halaman yang sesuai
      if (res.user.role === "admin" || res.user.role === "staff") {
        // Simpan token akses dan informasi pengguna ke localStorage
        localStorage.setItem("accessToken", res.token);
        localStorage.setItem("userInfo", JSON.stringify(res.user));
        return navigate("/admin"); // Arahkan ke halaman admin
      } else {
        // Simpan token akses dan informasi pengguna ke localStorage
        localStorage.setItem("accessToken", res.token);
        localStorage.setItem("userInfo", JSON.stringify(res.user));
        return navigate("/"); // Arahkan ke halaman utama (public)
      }
    } catch (error) {
      // Tangani kesalahan login, misalnya tampilkan pesan kepada pengguna
      console.error("Login gagal:", error); // Gunakan console.error untuk pesan kesalahan
      alert("Login gagal. Mohon periksa kembali kredensial Anda."); // Feedback dasar kepada pengguna
    }
  };

  // useEffect untuk mengalihkan pengguna jika sudah login
  // Peringatan ESLint 'navigate' sebagai dependensi telah diatasi.
  useEffect(() => {
    // Ambil accessToken di dalam useEffect untuk memastikan nilai terbaru
    const accessToken = localStorage.getItem("accessToken");
    if (accessToken) {
      navigate("/"); // `Maps` dimasukkan dalam array dependensi
    }
  }, [navigate]); // Tambahkan `Maps` ke array dependensi

  return (
    <section className="bg-gray-50 dark:bg-gray-900">
      <div className="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div className="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div className="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 className="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">Sign in to your account</h1>
            <form
              onSubmit={handleSubmit}
              className="space-y-4 md:space-y-6"
            >
              <div>
                <label
                  htmlFor="email"
                  className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Your email
                </label>
                <input
                  value={email}
                  onChange={handleEmail}
                  type="email"
                  name="email"
                  id="email"
                  className="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="name@company.com"
                  required
                />
              </div>
              <div>
                <label
                  htmlFor="password"
                  className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Password
                </label>
                <input
                  value={password}
                  onChange={handlePassword}
                  type="password"
                  name="password"
                  id="password"
                  placeholder="••••••••"
                  className="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  required
                />
              </div>
              <div className="flex items-center justify-between">
                <div className="flex items-start">
                  <div className="flex items-center h-5">
                    <input
                      id="remember"
                      aria-describedby="remember"
                      type="checkbox"
                      className="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-indigo-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-indigo-600 dark:ring-offset-gray-800"
                      required
                    />
                  </div>
                  <div className="ml-3 text-sm">
                    <label
                      htmlFor="remember"
                      className="text-gray-500 dark:text-gray-300"
                    >
                      Remember me
                    </label>
                  </div>
                </div>
                <a
                  href="#"
                  className="text-sm font-medium text-indigo-600 hover:underline dark:text-indigo-500"
                >
                  Forgot password?
                </a>
              </div>
              <button
                type="submit"
                className="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"
              >
                Sign in
              </button>
              <p className="text-sm font-light text-gray-500 dark:text-gray-400">
                Don’t have an account yet?{" "}
                <Link
                  to="/register"
                  className="font-medium text-indigo-600 hover:underline dark:text-indigo-500"
                >
                  Sign up
                </Link>
              </p>
            </form>
          </div>
        </div>
      </div>
    </section>
  );
}
