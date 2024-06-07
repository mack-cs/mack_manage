import { ChevronDownIcon, ChevronUpIcon } from "@heroicons/react/16/solid";
export default function TableHeading({
  name,
  sortable = true,
  sort_field = null,
  sort_direction = null,
  onSortChanged = null,
  children
}) {
  return (
    <th onClick={onSortChanged}>
      <div className={`px-3 py-2 ${sortable? "flex items-center justify-between gap-1 cursor-pointer": ''}`}>
        {children}
        {sortable && (
          <div>
            <ChevronUpIcon
              className={`w-4 ${
                name === sort_field &&
                sort_direction === 'asc'
                  ? "text-white"
                  : ""
              } `}
            />
            <ChevronDownIcon
              className={`w-4 -mt-2 ${
                name === sort_field &&
                sort_direction === 'desc'
                  ? "text-white"
                  : ""
              } `}
            />
          </div>
        )}
      </div>
    </th>
  );
}
