## CHANGELOG ##

#### v1.1.5 (XXXX-XX-XX) ####
- Merge z branchem 1.0

#### v1.1.4 (2013-08-29) ####
- Zmiana zależności od Symfony2 na wersje >=2.2.
- Dodano `PercentTypeExtension`
- Dodano `MoneyTypeExtension`
- Refaktoring form transformerów
- Dodano obsługę Money w Range
- Merge z branchem 1.0 (do tagu v1.0.6)
- Dodano opcje `min_options` i `max_options` w `RangeType`
- Dodano `PercentRangeValidator`

#### v1.1.3 (2013-07-09) ####
- Merge z branchem 1.0 (do tagu v1.0.4)

#### v1.1.2 (2013-06-28) ####
- Merge z branchem 1.0 (do tagu v1.0.3)

#### v1.1.1 (2013-05-23) ####
- CompilerPass tworzący abstrakcyjne repozytoria bazowe dla obiektów obsługiwanych przez DoctrineORM i DoctrineMongoDB.
- Zmiana nazwy (`StringToEnumTransformer` -> `EnumToValueTransformer`) i refaktoring transformera wykorzystywanego w `EnumType`

#### v1.0.7 (2013-XX-XX) ####
- Fix w `phpunit.xml.dist`
- Zgłoszenie serwisów CRUD i Clock.

#### v1.0.6 (2013-08-27) ####
- Dodanie walidatora dla MoneyRange.
- Dodanie walidatora dla DateRange.

#### v1.0.5 (2013-07-11) ####
- Poprawiona walidacja `Range`

#### v1.0.4 (2013-07-09) ####
 - Dodanie sortowania w `EnumChoiceList`
 - Dodanie opcji `multiple` w `EnumType`

#### v1.0.3 (2013-06-27) ####
- `trans_enum` zwraca pustą wartość dla enuma z wartością `null`
- `trans_enum` rzuca wyjątkiem, gdy podana wartość nie jest enumem

#### v1.0.2 (2013-05-27) ####
- Dodanie `NotNullEnumValidator` - walidator sprawdza, czy wartość enuma jest różna od null

#### v1.0.1 (2013-04-05) ####
- Poprawka w `EnumChoiceList`, gdy `choices` zawiera grupy

#### v1.0.0 (2013-03-21) ####
- Dodanie `DoctrineRepositoryPass` do ładowania abstrakcyjnych repozytoriów ORM i ODM
- Refaktoring opcji `range_suffix` w `RangeType`
- Dodanie opcji `trans_prefix` oraz `trans_domain` w `EnumType`
- Dodanie `TransEnumExtension` z filtrem `trans_enum`
