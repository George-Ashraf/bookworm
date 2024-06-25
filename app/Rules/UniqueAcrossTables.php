<?php
namespace App\Rules;
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueAcrossTables implements Rule
{
    protected $tables;
    protected $column;
    protected $ignoreTable;
    protected $ignoreId;

    /**
     * Create a new rule instance.
     *
     * @param array $tables
     * @param string $column
     * @param string|null $ignoreTable
     * @param int|null $ignoreId
     */
    public function __construct(array $tables, $column, $ignoreTable = null, $ignoreId = null)
    {
        $this->tables = $tables;
        $this->column = $column;
        $this->ignoreTable = $ignoreTable;
        $this->ignoreId = $ignoreId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->tables as $table) {
            $query = DB::table($table)->where($this->column, $value);

            if ($table === $this->ignoreTable && $this->ignoreId !== null) {
                $query->where('id', '!=', $this->ignoreId);
            }

            if ($query->exists()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}

