<?php
namespace App\Console\Commands\Classes;

class Product
{
    private ?float $averageRating = null;
    private array $images = [];
    private ?string $meetingPoint = null;

    private const SERIALIZABLE_PROPERTIES = [
        'averageRating',
        'images',
        'meetingPoint',
    ];

    public function setAverageRating(?float $averageRating): void
    {
        $this->averageRating = $averageRating;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    public function setMeetingPoint(?string $meetingPoint): void
    {
        $this->meetingPoint = $meetingPoint;
    }

    public function getAverageRating(): ?float
    {
        return $this->averageRating;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getMeetingPoint(): ?string
    {
        return $this->meetingPoint;
    }

    public function toJSON(bool $pretty = false): string
    {
        return json_encode(
            array_intersect_key(get_object_vars($this), array_flip(self::SERIALIZABLE_PROPERTIES)),
            $pretty ? (JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : 0
        );
    }

    public static function parse(array $data): self
    {
        $product = new self;

        if (isset($data['reviews']['reviewCountTotals'])) {
            $product->setAverageRating(
                round(
                    array_sum(
                        array_map(fn(array $value): int => $value['rating'] * $value['count'], $data['reviews']['reviewCountTotals'])
                    )
                    / array_sum(array_column($data['reviews']['reviewCountTotals'], 'count')),
                    2
                )    
            );
        }

        if (isset($data['images'])) {
            $productImages = [];
            foreach ($data['images'] as $image) {
                if (!isset($image['variants']) || count($image['variants']) === 0) {
                    continue;
                }

                usort($image['variants'], function($a, $b){
                    return $a['width'] < $b['width'];
                });

                $productImages[] = $image['variants'][0]['url'];
            }
            $product->setImages($productImages);
        }

        if (isset($data['description']) && !empty($data['description'])) {
            if (preg_match('/Meeting point: (.*) \\n\\n/', $data['description'], $matches) === 1) {
                $product->setMeetingPoint($matches[1]);
            }
        }
        return $product;
    }
}