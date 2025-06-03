import { useState, useEffect } from "react";
import { Dialog } from "@headlessui/react";
import { getGenres, createGenre, updateGenre, deleteGenre } from "../../../services/genres";
import { getAuthors, createAuthor, updateAuthor, deleteAuthor } from "../../../services/authors";
import { getBooks } from "../../../services/books";

export default function AdminGenreAuthorBook() {
  const [books, setBooks] = useState([]);
  const [genres, setGenres] = useState([]);
  const [authors, setAuthors] = useState([]);

  const [isGenreModalOpen, setIsGenreModalOpen] = useState(false);
  const [editingGenre, setEditingGenre] = useState(null);
  const [newGenre, setNewGenre] = useState("");

  const [isAuthorModalOpen, setIsAuthorModalOpen] = useState(false);
  const [editingAuthor, setEditingAuthor] = useState(null);
  const [newAuthor, setNewAuthor] = useState({ name: "", birth_date: "", bio: "" });

  useEffect(() => {
    const fetchData = async () => {
      try {
        const [booksData, genresData, authorsData] = await Promise.all([getBooks(), getGenres(), getAuthors()]);
        setBooks(booksData);
        setGenres(genresData);
        setAuthors(authorsData);
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    };

    fetchData();
  }, []);

  const handleGenreSubmit = async (e) => {
    e.preventDefault();
    try {
      if (editingGenre) {
        await updateGenre(editingGenre.id, { name: newGenre });
      } else {
        await createGenre({ name: newGenre });
      }
      setIsGenreModalOpen(false);
      setNewGenre("");
      setEditingGenre(null);
      const genresData = await getGenres();
      setGenres(genresData);
    } catch (error) {
      console.error("Error saving genre:", error);
    }
  };

  const handleAuthorSubmit = async (e) => {
    e.preventDefault();
    try {
      if (editingAuthor) {
        await updateAuthor(editingAuthor.id, newAuthor);
      } else {
        await createAuthor(newAuthor);
      }
      setIsAuthorModalOpen(false);
      setNewAuthor({ name: "", birth_date: "", bio: "" });
      setEditingAuthor(null);
      const authorsData = await getAuthors();
      setAuthors(authorsData);
    } catch (error) {
      console.error("Error saving author:", error);
    }
  };

  const handleEditGenre = (genre) => {
    setEditingGenre(genre);
    setNewGenre(genre.name);
    setIsGenreModalOpen(true);
  };

  const handleDeleteGenre = async (id) => {
    if (confirm("Are you sure you want to delete this genre?")) {
      await deleteGenre(id);
      const genresData = await getGenres();
      setGenres(genresData);
    }
  };

  const handleEditAuthor = (author) => {
    setEditingAuthor(author);
    setNewAuthor({
      name: author.name,
      birth_date: author.birth_date,
      bio: author.bio,
    });
    setIsAuthorModalOpen(true);
  };

  const handleDeleteAuthor = async (id) => {
    if (confirm("Are you sure you want to delete this author?")) {
      await deleteAuthor(id);
      const authorsData = await getAuthors();
      setAuthors(authorsData);
    }
  };

  return (
    <div className="space-y-10 p-6">
      {/* Books Section */}
      <section>
        <h1 className="text-2xl font-bold mb-4">Daftar Buku</h1>
        <div className="overflow-x-auto rounded-lg shadow">
          <table className="w-full text-sm text-left text-gray-500">
            <thead className="text-xs text-gray-700 uppercase bg-gray-100">
              <tr>
                <th className="px-4 py-3">Judul</th>
                <th className="px-4 py-3">Penulis</th>
                <th className="px-4 py-3">Genre</th>
              </tr>
            </thead>
            <tbody>
              {books.map((book) => (
                <tr
                  key={book.id}
                  className="bg-white border-b"
                >
                  <td className="px-4 py-3">{book.title}</td>
                  <td className="px-4 py-3">{book.author?.name || "-"}</td>
                  <td className="px-4 py-3">{book.genre?.name || "-"}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </section>

      {/* Genre Section */}
      <section className="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div className="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
          <div className="flex justify-between items-center p-4">
            <h2 className="text-2xl font-bold">Genres</h2>
            <button
              onClick={() => {
                setEditingGenre(null);
                setNewGenre("");
                setIsGenreModalOpen(true);
              }}
              className="text-white bg-indigo-700 hover:bg-indigo-800 px-4 py-2 rounded-lg text-sm"
            >
              Add Genre
            </button>
          </div>
          <div className="overflow-x-auto">
            <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th className="px-4 py-3">ID</th>
                  <th className="px-4 py-3">Name</th>
                  <th className="px-4 py-3">Actions</th>
                </tr>
              </thead>
              <tbody>
                {genres.map((genre) => (
                  <tr
                    key={genre.id}
                    className="border-b dark:border-gray-700"
                  >
                    <td className="px-4 py-3">{genre.id}</td>
                    <td className="px-4 py-3">{genre.name}</td>
                    <td className="px-4 py-3 space-x-2">
                      <button
                        onClick={() => handleEditGenre(genre)}
                        className="text-blue-600"
                      >
                        Edit
                      </button>
                      <button
                        onClick={() => handleDeleteGenre(genre.id)}
                        className="text-red-600"
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </section>

      {/* Author Section */}
      <section className="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div className="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
          <div className="flex justify-between items-center p-4">
            <h2 className="text-2xl font-bold">Authors</h2>
            <button
              onClick={() => {
                setEditingAuthor(null);
                setNewAuthor({ name: "", birth_date: "", bio: "" });
                setIsAuthorModalOpen(true);
              }}
              className="text-white bg-indigo-700 hover:bg-indigo-800 px-4 py-2 rounded-lg text-sm"
            >
              Add Author
            </button>
          </div>
          <div className="overflow-x-auto">
            <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th className="px-4 py-3">ID</th>
                  <th className="px-4 py-3">Name</th>
                  <th className="px-4 py-3">Birth Date</th>
                  <th className="px-4 py-3">Bio</th>
                  <th className="px-4 py-3">Actions</th>
                </tr>
              </thead>
              <tbody>
                {authors.map((author) => (
                  <tr
                    key={author.id}
                    className="border-b dark:border-gray-700"
                  >
                    <td className="px-4 py-3">{author.id}</td>
                    <td className="px-4 py-3">{author.name}</td>
                    <td className="px-4 py-3">{author.birth_date}</td>
                    <td className="px-4 py-3">{author.bio}</td>
                    <td className="px-4 py-3 space-x-2">
                      <button
                        onClick={() => handleEditAuthor(author)}
                        className="text-blue-600"
                      >
                        Edit
                      </button>
                      <button
                        onClick={() => handleDeleteAuthor(author.id)}
                        className="text-red-600"
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </section>

      {/* Genre Modal */}
      <Dialog
        open={isGenreModalOpen}
        onClose={() => setIsGenreModalOpen(false)}
        className="relative z-50"
      >
        <div
          className="fixed inset-0 bg-black/30"
          aria-hidden="true"
        />
        <div className="fixed inset-0 flex items-center justify-center p-4">
          <Dialog.Panel className="bg-white rounded-lg p-6 w-full max-w-sm">
            <Dialog.Title className="text-lg font-medium mb-4">{editingGenre ? "Edit Genre" : "Add Genre"}</Dialog.Title>
            <form onSubmit={handleGenreSubmit}>
              <input
                type="text"
                value={newGenre}
                onChange={(e) => setNewGenre(e.target.value)}
                className="w-full border rounded-lg p-2 mb-4"
                placeholder="Genre name"
                required
              />
              <div className="flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setIsGenreModalOpen(false)}
                  className="px-4 py-2 text-gray-600 hover:text-gray-800"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  className="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                >
                  Save
                </button>
              </div>
            </form>
          </Dialog.Panel>
        </div>
      </Dialog>

      {/* Author Modal */}
      <Dialog
        open={isAuthorModalOpen}
        onClose={() => setIsAuthorModalOpen(false)}
        className="relative z-50"
      >
        <div
          className="fixed inset-0 bg-black/30"
          aria-hidden="true"
        />
        <div className="fixed inset-0 flex items-center justify-center p-4">
          <Dialog.Panel className="bg-white rounded-lg p-6 w-full max-w-sm">
            <Dialog.Title className="text-lg font-medium mb-4">{editingAuthor ? "Edit Author" : "Add Author"}</Dialog.Title>
            <form onSubmit={handleAuthorSubmit}>
              <input
                type="text"
                value={newAuthor.name}
                onChange={(e) => setNewAuthor({ ...newAuthor, name: e.target.value })}
                className="w-full border rounded-lg p-2 mb-4"
                placeholder="Author name"
                required
              />
              <input
                type="date"
                value={newAuthor.birth_date}
                onChange={(e) => setNewAuthor({ ...newAuthor, birth_date: e.target.value })}
                className="w-full border rounded-lg p-2 mb-4"
                required
              />
              <textarea
                value={newAuthor.bio}
                onChange={(e) => setNewAuthor({ ...newAuthor, bio: e.target.value })}
                className="w-full border rounded-lg p-2 mb-4"
                placeholder="Author bio"
                rows="3"
                required
              />
              <div className="flex justify-end gap-2">
                <button
                  type="button"
                  onClick={() => setIsAuthorModalOpen(false)}
                  className="px-4 py-2 text-gray-600 hover:text-gray-800"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  className="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                >
                  Save
                </button>
              </div>
            </form>
          </Dialog.Panel>
        </div>
      </Dialog>
    </div>
  );
}
