import API from "../api";

// Ambil semua author
export const getAuthors = async () => {
  const { data } = await API.get("/authors");
  return data.data;
};

// Tambah author baru
export const createAuthor = async (authorData) => {
  try {
    const response = await API.post("/authors", authorData);
    return response.data;
  } catch (error) {
    console.error("Error creating author:", error);
    throw error;
  }
};

// Perbarui author berdasarkan ID
export const updateAuthor = async (id, authorData) => {
  try {
    const response = await API.put(`/authors/${id}`, authorData);
    return response.data;
  } catch (error) {
    console.error("Error updating author:", error);
    throw error;
  }
};

// Hapus author berdasarkan ID
export const deleteAuthor = async (id) => {
  try {
    const response = await API.delete(`/authors/${id}`);
    return response.data;
  } catch (error) {
    console.error("Error deleting author:", error);
    throw error;
  }
};
