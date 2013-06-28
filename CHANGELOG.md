## CHANGELOG ##

#### v1.1.1 (2013-05-23) ####
- CompilerPass tworzący abstrakcyjne repozytoria bazowe dla obiektów obsługiwanych przez DoctrineORM i DoctrineMongoDB.
- Zmiana nazwy (`StringToEnumTransformer` -> `EnumToValueTransformer`) i refaktoring transformera wykorzystywanego w `EnumType`

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
