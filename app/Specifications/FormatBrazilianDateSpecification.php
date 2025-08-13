<?php

namespace App\Specifications;

use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

/**
 * FormatBrazilianDateSpecification
 *
 * Formats configured date fields into Brazilian pattern (dd/mm/YYYY HH:ii).
 */
class FormatBrazilianDateSpecification implements ResultSpecification
{
    /** @var array<int, string> */
    private array $dateFields;

    private string $format;
    private string $timezone;

    /**
     * @param array<int, string> $dateFields   Fields to format (e.g. ["created_at","updated_at"])
     * @param string             $format       Output format (default: d/m/Y H:i)
     * @param string             $timezone     IANA timezone (default: America/Sao_Paulo)
     */
    public function __construct(array $dateFields, string $format = 'd/m/Y H:i', string $timezone = 'America/Sao_Paulo')
    {
        $this->dateFields = $dateFields;
        $this->format = $format;
        $this->timezone = $timezone;
    }

    /** @inheritDoc */
    public function apply(array|Collection $items): array
    {
        $array = $items instanceof Collection ? $items->toArray() : $items;

        return array_map(function (array $row): array {
            foreach ($this->dateFields as $field) {
                if (!empty($row[$field])) {
                    // Carbon handles strings, timestamps, DateTime, etc.
                    $row[$field] = Carbon::parse($row[$field])
                        ->timezone($this->timezone)
                        ->format($this->format);
                }
            }
            return $row;
        }, $array);
    }
}
