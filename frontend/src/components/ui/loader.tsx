export default function Loader() {
  return (
    <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-50">
      <div className="flex-col gap-4 w-full flex items-center justify-center">
        <div className="w-28 h-28 border-8 text-primary text-4xl animate-spin border-gray-300 flex items-center justify-center border-t-primary rounded-full"></div>
      </div>
    </div>
  );
}
